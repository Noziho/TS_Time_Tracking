export class Timer {

    public TimerButton(): void {

        let interval: any = null;
        let timerButtons: NodeListOf<Element> = document.querySelectorAll('.timer') as NodeListOf<Element>;
        let secondsIterator: number = 0;
        if (timerButtons) {
            timerButtons.forEach((element: any) => {


                element.addEventListener("click", (e: MouseEvent) => {
                    timerButtons.forEach((elem: any) => {
                        elem.className = "disabled";
                    })

                    element.className = "activatedTimer";
                    element.innerHTML = "Stop";


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
                })

            })
        }
    }

}