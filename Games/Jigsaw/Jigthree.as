package
{
	import flash.display.*;
	import flash.events.*;
	import flash.net.URLRequest;
	import flash.geom.*;
	
	public class Jigthree extends MovieClip
	{
		const numColumns:int = 4;
		const numRows:int = 3;
		var pieceWidth:Number;
		var pieceHeight:Number;
		// containers for the puzzle pieces
		var puzzlePieces:Array = new Array();
		var selectedPieces:Sprite;
		var otherPieces:Sprite; 
		var beingDragged:Array;
		
		public function Jigthree()
		{
			loadBitmap("Jigthree.jpg");
			selectedPieces = new Sprite();
			otherPieces = new Sprite();
			addChild(otherPieces);
			addChild(selectedPieces);
		}
		
		// loads a bitmap from the specified file
		// calls loadingDone when loading is complete
		public function loadBitmap(filename:String)
		{
			var loader:Loader = new Loader();
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, loadingDone);
			var request:URLRequest = new URLRequest(filename);
			loader.load(request);
		}
		
		public function loadingDone(event:Event)
		{
			// get the image from the loader
			var image:Bitmap = Bitmap(event.target.loader.content);
			// work out the size of the pieces
			pieceWidth = Math.floor((image.width/numColumns)/10)*10;
			pieceHeight = Math.floor((image.height/numRows)/10)*10;
			// extract the bitmap data from the image, and break it up into bits
			makePuzzlePieces(image.bitmapData);
			// add event listeners
			addEventListener(Event.ENTER_FRAME, movePieces);
			stage.addEventListener(MouseEvent.MOUSE_UP, mouseUpFunction);
		}
		
		public function makePuzzlePieces(data:BitmapData)
		{
			for (var x:uint=0; x<numColumns; x++)
			{
				for (var y:uint=0; y<numRows; y++)
				{
					// create puzzle piece bitmap and sprite
					// we need a sprite so we can add an event-listener to it
					var piece:Bitmap = new Bitmap(new BitmapData(pieceWidth, pieceHeight));
					piece.bitmapData.copyPixels(data, new Rectangle(x*pieceWidth,y*pieceHeight,pieceWidth,pieceHeight), new Point(0,0));
					var pieceSprite:Sprite = new Sprite();
					pieceSprite.addChild(piece);
					pieceSprite.addEventListener(MouseEvent.MOUSE_DOWN, clickPuzzlePiece);
					// place in the non-selected pieces sprite
					otherPieces.addChild(pieceSprite);
					// create an object to store the piece information
					var pieceObject:Object = new Object();
					pieceObject.locn = new Point(x,y); // location in puzzle - column, row
					pieceObject.dragOffset = null; // offset from cursor
					pieceObject.piece = pieceSprite;
					puzzlePieces.push(pieceObject);
				}
			}
			shufflePieces();
		}
		
		// place pieces at random locations
		public function shufflePieces()
		{
			for (var i in puzzlePieces)
			{
				puzzlePieces[i].piece.x = Math.random()*700+50;
				puzzlePieces[i].piece.y = Math.random()*580+20;
			}
			snapPiecesToGrid();
		}
		
		// snap each piece to its nearest grid location
		public function snapPiecesToGrid()
		{
			for (var i in puzzlePieces)
			{
				puzzlePieces[i].piece.x = 10 * Math.round(puzzlePieces[i].piece.x/10);
				puzzlePieces[i].piece.y = 10 * Math.round(puzzlePieces[i].piece.y/10);
			}
		}
		
		public function clickPuzzlePiece(event:MouseEvent)
		{
			var clickLoc:Point = new Point(event.stageX, event.stageY);
			beingDragged = new Array();
			// find the piece clicked on
			for (var i in puzzlePieces)
			{
				if (puzzlePieces[i].piece == event.currentTarget)
				{
					beingDragged.push(puzzlePieces[i]);
					puzzlePieces[i].dragOffset = new Point(clickLoc.x - puzzlePieces[i].piece.x, clickLoc.y - puzzlePieces[i].piece.y); 
					selectedPieces.addChild(puzzlePieces[i].piece);
					// find other pieces attached to this bit
					findAttachedPieces(i,clickLoc);
					break; // exit the loop - no need to test other pieces
				}
			}
		}
		
		public function findAttachedPieces(clickedPiece:uint, clickLoc:Point)
		{
			// create a list of pieces sorted by distance from the clicked piece
			var sortedObjects:Array = new Array();
			for (var i in puzzlePieces)
			{
				if (i!=clickedPiece) // don't include the clicked piece
				{
					// push a dynamically created object into the sorting list
					sortedObjects.push({dist: Point.distance(puzzlePieces[clickedPiece].locn, puzzlePieces[i].locn), num:i});
				}
			}
			sortedObjects.sortOn("dist", Array.DESCENDING);
			// loop repeatedly through pieces looking for pieces connected to those already selected
			do
			{
				var foundALink:Boolean = false;
				// check objects from closest to furthest away
				for(i=sortedObjects.length-1; i>=0; i--)
				{
					var n:uint = sortedObjects[i].num;
					// find position relative to the clicked piece
					var diffX:int = puzzlePieces[n].locn.x - puzzlePieces[clickedPiece].locn.x;
					var diffY:int = puzzlePieces[n].locn.y - puzzlePieces[clickedPiece].locn.y;
					// check if it is in the right position to be attached
					if (puzzlePieces[n].piece.x == (puzzlePieces[clickedPiece].piece.x + pieceWidth*diffX))
						if (puzzlePieces[n].piece.y == (puzzlePieces[clickedPiece].piece.y + pieceHeight*diffY))
							if (isConnected(puzzlePieces[n]))
							{
								// piece is attached so add to the data structures
								beingDragged.push(puzzlePieces[n]);
								selectedPieces.addChild(puzzlePieces[n].piece);
								puzzlePieces[n].dragOffset = new Point(clickLoc.x - puzzlePieces[n].piece.x, clickLoc.y - puzzlePieces[n].piece.y); 
								sortedObjects.splice(i,1); // remove from array so its isn't tested again
								foundALink = true; // force another loop through the pieces
							}
				}
			} while (foundALink);
		}
		
		// tests if this piece is connected to one already selected
		// true if they are either 1 row apart or 1 column apart
		public function isConnected(thisPiece:Object):Boolean
		{
			for (var i in beingDragged)
			{
				var rowDiff:int = Math.abs(thisPiece.locn.x - beingDragged[i].locn.x);
				var colDiff:int = Math.abs(thisPiece.locn.y - beingDragged[i].locn.y);
				if (rowDiff + colDiff == 1)
					return true;
			}
			return false;
		}
		
		// move all the pieces to be based on the new cursor location
		public function movePieces(event:Event)
		{
			for (var i in beingDragged)
			{
				beingDragged[i].piece.x = mouseX - beingDragged[i].dragOffset.x;
				beingDragged[i].piece.y = mouseY - beingDragged[i].dragOffset.y;				
			}
		}
		
		// mouse up, so drop the pieces being dragged
		public function mouseUpFunction(event:Event)
		{
			snapPiecesToGrid();
			// put the selected pieces back into the otherPieces sprite
			for (var i in beingDragged)
			{
				otherPieces.addChild(beingDragged[i].piece);
			}
			// clear drag array
			beingDragged = new Array();
			// check for game-over
			if (puzzleTogether())
			{
				cleanUpJigthree();
				gotoAndStop("finish");
				
			}
		}
		
		// puzzle is finished if all pieces are correctly placed relative to piece 0
		public function puzzleTogether():Boolean
		{
			var col0 = puzzlePieces[0].locn.x;
			var row0 = puzzlePieces[0].locn.y;
			var x0 = puzzlePieces[0].piece.x;
			var y0 = puzzlePieces[0].piece.y;
		
			for (var i:uint=1;i<puzzlePieces.length; i++)
			{
				var colDiff:int = puzzlePieces[i].locn.x - col0;
				var rowDiff:int = puzzlePieces[i].locn.y - row0;
				if (puzzlePieces[i].piece.x != x0 + pieceWidth * colDiff)
					return false;
				if (puzzlePieces[i].piece.y != y0 + pieceHeight * rowDiff)
					return false;
			}
			return true;
		}
		
		public function cleanUpJigthree()
		{
			removeChild(selectedPieces);
			removeChild(otherPieces);
			selectedPieces = null;
			otherPieces = null;
			puzzlePieces = null;
			beingDragged = null;
			removeEventListener(Event.ENTER_FRAME, movePieces);
			stage.removeEventListener(MouseEvent.MOUSE_UP, mouseUpFunction);
						
		}
		
	}
}