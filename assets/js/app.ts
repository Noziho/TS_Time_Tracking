import '../styles/style.scss';
import {Project} from "./Project";
import {Display} from "./Display";




let test = new Project();
test.createButtonProject();


let display: Display = new Display() as Display;
display.displayProjectFromLocalStorage();
display.displayProjectDetails();

console.log(JSON.parse(localStorage.getItem("Projects")as string));
