function gclick() {
var container1Element = document.querySelector('#box1');

var container12Element = document.createElement('div');
var courseElement = document.createElement('div');
var coursepreviewElement = document.createElement('div');
var imgElement = document.createElement('img');
var courseinfoElement = document.createElement('div');
var h6Element = document.createElement('h6');
var h2Element = document.createElement('h2');
var btnElement = document.createElement('button');

container12Element.className = "container-1-2";
courseElement.className = "course";
coursepreviewElement.className = "course-preview";
courseinfoElement.className = "course-info";
btnElement.className = "btn";

imgElement.src = "img/map.jpg";

imgElement.setAttribute("height", "200");
imgElement.setAttribute("width", "200");

h6Element.innerText = "Katraj,Pune";
h2Element.innerText = "Food Packets for 50 People";
btnElement.innerText = "More Info";
    
container1Element.append(container12Element);
container12Element.append(courseElement);
courseElement.append(coursepreviewElement, courseinfoElement);
coursepreviewElement.append(imgElement);
courseinfoElement.append(h6Element, h2Element, btnElement);
    
    
}