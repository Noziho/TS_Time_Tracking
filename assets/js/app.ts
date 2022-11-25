import '../styles/style.scss';
import {Project} from "./Project";

console.log("Loaded TS");


let test: Project = new Project('test') as Project;

console.log(test);