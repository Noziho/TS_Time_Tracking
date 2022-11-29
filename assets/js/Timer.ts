export class Timer {

    public TimerButton (containerForButton : HTMLDivElement):void {
        const timerButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        timerButton.innerHTML = "Timer";

        containerForButton.append(timerButton);
    }
}