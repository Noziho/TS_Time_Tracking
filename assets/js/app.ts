import '../styles/style.scss';
import {Display} from "./Display";


let tasks: NodeListOf<Element> = document.querySelectorAll('.task') as NodeListOf<Element>;

if (tasks) {
    let display = new Display();
    display.display();
}

let success: HTMLDivElement = document.querySelector('.success') as HTMLDivElement;
let error: HTMLDivElement = document.querySelector('.error') as HTMLDivElement;

if (success) {
    setTimeout(() => {
        success.remove();
    }, 3000);

    success.addEventListener("click",() => {
        success.remove();
    })
}

if (error) {
    setTimeout(() => {
        error.remove();
    }, 3000)

    error.addEventListener("click",() => {
        error.remove();
    })
}




