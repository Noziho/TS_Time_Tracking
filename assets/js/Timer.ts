import {Project} from "./Project";
import {Tasks} from "./Tasks";

export class Timer {

    public TimerButton (containerForButton : HTMLDivElement, project: any, taskTitle: HTMLParagraphElement, allProjectArray: Project[], i:number):void {

        const containerTimer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
        containerTimer.className = "containerTimer";

        const timerButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        timerButton.innerHTML = "Timer";

        const stopTimer: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        stopTimer.innerHTML = "Stop";

        const totalTime: HTMLSpanElement = document.createElement("span") as HTMLSpanElement;
        totalTime.id = "timer";

        timerButton.addEventListener("click",
            (e: MouseEvent) => {
                timerButton.remove();
                containerTimer.append(stopTimer);
                let secondsIterator: number = 0;
                if (project.tasks[i-1].totalTime < 0) {
                    secondsIterator = 0;
                }else {
                    secondsIterator = project.tasks[i-1].totalTime;
                }


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

                stopTimer.addEventListener("click",
                    (e: MouseEvent) => {
                        clearInterval(interval);
                        stopTimer.remove();
                        containerTimer.append(timerButton);

                        if (!project.tasks) {
                            return;
                        }
                        let task = new Tasks();
                        task.title = taskTitle.innerHTML;
                        if (task.totalTime !== 0) {
                            task.totalTime += secondsIterator;
                        } else {
                            task.totalTime = secondsIterator;
                        }
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