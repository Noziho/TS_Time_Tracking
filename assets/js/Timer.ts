export class Timer {

    public TimerButton(containerButton: HTMLDivElement, elemId: number): void {

        let interval: any = null;
        let timerButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        timerButton.innerHTML = "Timer";
        timerButton.className = "timer";

        let stopTimer: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        stopTimer.innerHTML = "Stop";


        let secondsIterator: number = 0;


        timerButton.addEventListener("click", (e: MouseEvent) => {
            let timerButtons: NodeListOf<Element> = document.querySelectorAll('.timer') as NodeListOf<Element>;
            timerButtons.forEach((elem: any) => {
                elem.className = "disabled";
            })

            console.log(timerButtons)

            timerButton.className = "activatedTimer";
            timerButton.innerHTML = "Stop";
            timerButton.remove();
            containerButton.append(stopTimer);
            interval = setInterval(() => {
                secondsIterator++;
                if (secondsIterator) {
                    let dateObj = new Date(secondsIterator * 1000);
                    let hours = dateObj.getUTCHours();
                    let minutes = dateObj.getUTCMinutes();
                    let seconds = dateObj.getSeconds();
                    console.log(secondsIterator);
                }

            }, 1000);




            stopTimer.addEventListener("click", (e: MouseEvent) => {
                stopTimer.remove();
                clearInterval(interval);
                timerButton.innerHTML = "Timer";
                containerButton.append(timerButton);

                    let disabledButtons: NodeListOf<Element> = document.querySelectorAll('.disabled') as NodeListOf<Element>;
                    disabledButtons.forEach((elem: any) => {
                        elem.className = "timer";
                    })
                timerButton.className = "timer";
                        fetch(`/?c=tasks&a=timeRegister&id=${elemId}`)
                            .then(response => response.json())
                            .then(response => {
                                console.log(response.task);
                            })

                location.reload();
                })
        })

        containerButton.append(timerButton);


    }

}