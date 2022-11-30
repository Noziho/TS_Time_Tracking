export class Timer {

    public TimerButton (containerForButton : HTMLDivElement):void {

        const containerTimer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
        containerTimer.className = "containerTimer";
        const timerButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        timerButton.innerHTML = "Timer";

        const hours: HTMLSpanElement = document.createElement("span") as HTMLSpanElement;
        const minutes: HTMLSpanElement = document.createElement("span") as HTMLSpanElement;
        const seconds: HTMLSpanElement = document.createElement("span") as HTMLSpanElement;

        timerButton.addEventListener("click", (e: MouseEvent) => {
            console.log("test");
        })

        containerTimer.append(timerButton);

        containerForButton.append(containerTimer);
    }
}