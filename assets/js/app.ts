import '../styles/style.scss';
import {Project} from "./Project";
import {Display} from "./Display";



alert("OE OE");

let test = new Project();
test.createButtonProject();


let display: Display = new Display() as Display;
display.displayProjectFromLocalStorage();
display.displayProjectDetails();

/**
 * window.onunload = function() {
 *     localStorage.setItem("TEST", "register on close 22233322");
 * }
 */

console.log(JSON.parse(localStorage.getItem("Projects")as string));
