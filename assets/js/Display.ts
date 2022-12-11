import {Timer} from "./Timer";

export class Display {

    display () {
        let tasks: NodeListOf<Element> = document.querySelectorAll('.task') as NodeListOf<Element>;

        tasks.forEach((elem: any) => {
            let timer = new Timer();
            timer.TimerButton(elem, elem.id);
        })
    }
}