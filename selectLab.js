"use strict";

document.observe("dom:loaded", function() {
	/* Make necessary elements Dragabble / Droppables (Hint: use $$ function to get all images).
	 * All Droppables should call 'labSelect' function on 'onDrop' event. (Hint: set revert option appropriately!)
	 * 필요한 모든 element들을 Dragabble 혹은 Droppables로 만드시오 (힌트 $$ 함수를 사용하여 모든 image들을 찾으시오).
	 * 모든 Droppables는 'onDrop' 이벤트 발생시 'labSelect' function을 부르도록 작성 하시오. (힌트: revert옵션을 적절히 지정하시오!)
	 */	
	
	$$('img').each(function(stack){
		var myDraggable = new Draggable(stack,{revert: true});
		Droppables.add('selectpad', { 
		    accept: $(this),
		    onDrop: labSelect
		});
  	
  		$('selectpad').cleared = false;
	}); 

});


var count = 0;

function labSelect(drag, drop, event) {
	/* Complete this event-handler function 
	 * 이 event-handler function을 작성하시오.
	 */
	if(count<3){
		if (!drop.cleared) {
	        drop.innerHTML = '';
	        drop.cleared = true;
	    }
			

	    drag.parentNode.removeChild(drag);
	    drop.appendChild(drag);
	    var li = document.createElement('li');
	    var text = document.createTextNode(drag.alt);
        li.appendChild(text);
        $('selection').appendChild(li);
        li.pulsate({duration:1, delay:0.5});
	    count++;
	}

}


