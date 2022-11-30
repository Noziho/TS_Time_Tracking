export class Timer {

    public totalTimeTask: string = "";

    public TimerButton (containerForButton : HTMLDivElement):void {

        const containerTimer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
        containerTimer.className = "containerTimer";

        const timerButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        timerButton.innerHTML = "Timer";

        const stopTimer: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        stopTimer.innerHTML = "Stop";

        const totalTime: HTMLSpanElement = document.createElement("span") as HTMLSpanElement;

        timerButton.addEventListener("click", (e: MouseEvent) => {
            timerButton.remove();
            containerTimer.append(stopTimer);
            let seconds: number = 0;
            let minutes: number = 0;
            let hours: number = 0;
            let interval: ReturnType<typeof setInterval> = setInterval(() => {
                seconds++;
                if (seconds === 60) {
                    minutes++;
                    seconds = 0;
                }
                if (minutes === 60) {
                    hours++;
                    minutes = 0;
                    seconds = 0;
                }
                this.totalTimeTask = `${hours}:${minutes}:${seconds}`
                totalTime.innerHTML = this.totalTimeTask;

            }, 1000);

            stopTimer.addEventListener("click", (e:MouseEvent) => {
                clearInterval(interval);
                stopTimer.remove();
                containerTimer.append(timerButton);
            })
        })





        containerTimer.append(timerButton);
        containerTimer.append(totalTime);
        containerForButton.append(containerTimer);
    }

}