import {Project} from "./Project";
import {Tasks} from "./Tasks";

export class Timer {

    public TimerButton(containerForButton: HTMLDivElement, project: any, taskTitle: HTMLParagraphElement, allProjectArray: Project[], i: number): void {

        const containerTimer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
        containerTimer.className = "containerTimer";

        const timerButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        timerButton.innerHTML = "Timer";
        timerButton.className = "timerButton";

        const stopTimer: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        stopTimer.innerHTML = "Stop";

        const totalTime: HTMLSpanElement = document.createElement("span") as HTMLSpanElement;

        /**
         * Start timer and display the stop button when clicked and remove all other timer button.
         */
        timerButton.addEventListener("click",
            (e: MouseEvent) => {
                timerButton.className = "activatedTimer";
                let disabledButton: NodeListOf<Element> = document.querySelectorAll('.timerButton') as NodeListOf<Element>;
                disabledButton.forEach((button: Element) => {
                    button.className = "disabled";
                })
                timerButton.remove();
                containerTimer.append(stopTimer);

                let secondsIterator: number = 0;

                /**
                 * Get time from localStorage.
                 */
                if (project.tasks[i - 1].totalTime <= 0) {
                    secondsIterator = 0;
                } else {
                    secondsIterator = project.tasks[i - 1].totalTime;
                }


                /**
                 * Start timer iteration and convert seconds to hours minutes and seconds.
                 */

                let interval: ReturnType<typeof setInterval> = setInterval(() => {
                    secondsIterator++;
                    if (secondsIterator) {
                        let dateObj = new Date(secondsIterator * 1000);
                        let hours = dateObj.getUTCHours();
                        let minutes = dateObj.getUTCMinutes();
                        let seconds = dateObj.getSeconds();
                        totalTime.innerHTML = `${hours}:${minutes}:${seconds}`
                    }

                }, 1000);

                /**
                 * Stop timer when clicked
                 */
                stopTimer.addEventListener("click",
                    (e: MouseEvent) => {
                        clearInterval(interval);
                        stopTimer.remove();
                        containerTimer.append(timerButton);

                        let date = new Date();
                        let day = date.getDate();
                        let month = date.getMonth() + 1;
                        let year = date.getFullYear();

                        let task = new Tasks();
                        task.title = taskTitle.innerHTML;
                        task.totalTime = secondsIterator;
                        task.lastInteraction = `${day}/${month}/${year}`;


                        project.tasks.splice(i - 1, 1, task);

                        localStorage.setItem("Projects", JSON.stringify(allProjectArray));

                        secondsIterator = 0;
                        location.reload();
                    })
            })

        containerTimer.append(timerButton);
        containerTimer.append(totalTime);
        containerForButton.append(containerTimer);
    }

}