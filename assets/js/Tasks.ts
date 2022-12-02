import {Project} from "./Project";
import {Timer} from "./Timer";

export class Tasks {
    public title:string = "";
    public totalTime:number = 0;

    public createTask (allProjectArray: Project[],element: Project, projectContainer: HTMLDivElement, inputForNameTask: HTMLInputElement, addTaskButton: HTMLButtonElement, totalTime: number = 0) {

        addTaskButton.addEventListener("click", (e: MouseEvent) => {


            if (element.tasks) {
                let task = new Tasks();
                task.title = inputForNameTask.value;
                task.totalTime = totalTime;
                element.tasks.push(task);
            }

            let id:number = 0;

            element.tasks?.forEach(() => {
                id++;
            })
            /**
             * Display the task on click.
             */
            const taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            taskContainer.className = "task padding-1 margin-top-1";
            taskContainer.id = id.toString();

            const titleOfTask: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
            titleOfTask.innerHTML = inputForNameTask.value;


            const timer: Timer = new Timer() as Timer;

            taskContainer.append(titleOfTask);
            projectContainer.append(taskContainer);

            let iterator: number = parseInt(taskContainer.id);

            timer.TimerButton(taskContainer, element, titleOfTask, allProjectArray, iterator);

            localStorage.setItem("Projects", JSON.stringify(allProjectArray));
        })

        projectContainer.append(inputForNameTask);
        projectContainer.append(addTaskButton);
    }
}