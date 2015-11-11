"use strict"
window.onload = function () {
    var stack = [];
    var stackNum=0;
    var displayVal = "0";
    var firstDisp = "0";
    var deciCheck = /\./;
    var numCheck = /^[0-9]$/;
    var opCheck = /[*-+\/\^]/;
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;
            if(value=="AC"){
                displayVal = "0";
            }else if(numCheck.test(value)){
                displayVal = value;
            }else if(value=="."){
                displayVal = value;
            }
            
            if(firstDisp=="0"){
                document.getElementById('result').innerHTML =  displayVal; 
                firstDisp = displayVal;
            }else if(value=="AC"){
                document.getElementById('result').innerHTML =  "0";
                firstDisp = displayVal;
            }else if(opCheck.test(value)){
                stack[stackNum] = document.getElementById('result').innerHTML;
                stackNum++;
                stack[stackNum] = value;
                stackNum++;
                document.getElementById('expression').innerHTML = 0;
                for(var i=0;i<stackNum;i++){
                    document.getElementById('expression').innerHTML +=  stack[i]; 
                }
                document.getElementById('result').innerHTML =  "0";
                firstDisp=0;
            }else if(!deciCheck.test(document.getElementById('result').innerHTML) || displayVal!="."){
                document.getElementById('result').innerHTML +=  displayVal;
                firstDisp = displayVal; 
            }
            
        };
    }
};
function factorial (x) {

}
function highPriorityCalculator(s, val) {

}
function calculator(s) {
    var result = 0;
    var operator = "+";
    for (var i=0; i< s.length; i++) {
        
    }
    return result;
}
