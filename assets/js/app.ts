import '../styles/style.scss';
import {Display} from "./Display";


let tasks: NodeListOf<Element> = document.querySelectorAll('.task') as NodeListOf<Element>;

if (tasks) {
    let display = new Display();
    display.display();
}
