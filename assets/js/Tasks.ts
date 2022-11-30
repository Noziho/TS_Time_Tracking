import {Project} from "./Project";
import {Timer} from "./Timer";

export class Tasks {
    public title:string = "";
    public totalTime:string = "";

    public createTask (allProjectArray: Project[],element: Project, projectContainer: HTMLDivElement, totalTime: string = "") {

        const inputForNameTask = document.createElement("input");

        const addTaskButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        addTaskButton.innerHTML = "addTask";


        addTaskButton.addEventListener("click", (e: MouseEvent) => {


            if (element.tasks) {
                let task = new Tasks();
                task.title = inputForNameTask.value;
                element.tasks.push(task);
                this.totalTime = totalTime;
            }

            /**
             * Display the task on click.
             */
            const taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            taskContainer.className = "task padding-1 margin-top-1";

            const titleOfTask: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
            titleOfTask.innerHTML = inputForNameTask.value;


            const timer: Timer = new Timer() as Timer;

            taskContainer.append(titleOfTask);
            projectContainer.append(taskContainer);

            timer.TimerButton(taskContainer);

            localStorage.setItem("Projects", JSON.stringify(allProjectArray));
        })


        projectContainer.append(inputForNameTask);
        projectContainer.append(addTaskButton);
    }
}