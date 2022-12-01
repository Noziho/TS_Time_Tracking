import '../styles/style.scss';
import {Project} from "./Project";
import {Display} from "./Display";



let test = new Project();
test.createButtonProject();


let display: Display = new Display() as Display;
display.displayProjectFromLocalStorage();

/**
 * window.onunload = function() {
 *     localStorage.setItem("TEST", "register on close 22233322");
 * }
 */
