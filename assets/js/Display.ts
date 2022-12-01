import {Project} from "./Project";
import {Timer} from "./Timer";
import {Tasks} from "./Tasks";
import * as stream from "stream";

export class Display {

    public displayProjectFromLocalStorage() {

        /**
         * Get all project from localStorage
         */
        let allProjectsString: string = localStorage.getItem("Projects") as string;
        let allProjectArray = JSON.parse(allProjectsString);

        let allProjectsContainer: HTMLDivElement = document.querySelector(".projects_container") as HTMLDivElement;

        allProjectArray.forEach((element: Project) => {

            /**
             * Just display the title from the localStorage Project.
             */

            let projectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            projectContainer.className = "project padding-1 margin-2";

            let titleProject: HTMLHeadingElement = document.createElement("h2") as HTMLHeadingElement;
            if (typeof element.title === "string") {
                titleProject.innerHTML = element.title;
            }

            /**
             * Display deletion button
             */

            let deletionButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
            deletionButton.innerHTML = "Delete project"

            deletionButton.addEventListener("click", (e: MouseEvent) => {
                element.title = null;
                if (element.tasks) {
                    element.tasks.splice(0, element.tasks.length)
                    localStorage.setItem("Projects", JSON.stringify(allProjectArray));
                }
                projectContainer.remove();
            })


            projectContainer.append(titleProject);
            projectContainer.append(deletionButton);
            allProjectsContainer.prepend(projectContainer);
            /**
             * Display add task button.
             */

            const inputForNameTask = document.createElement("input");

            const addTaskButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
            addTaskButton.innerHTML = "addTask";

            /**
             * Make a new task
             */

            let task = new Tasks();
            task.createTask(allProjectArray, element, projectContainer, inputForNameTask, addTaskButton);

            /**
             * Display all task from all project when the page is loading.
             */

            if (element.tasks) {
                if (element.title === null) {
                    projectContainer.remove();
                }
                element.tasks.forEach((e) => {
                    const taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
                    taskContainer.className = "task padding-1 margin-top-1";

                    const titleOfTask: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
                    titleOfTask.innerHTML = e.title;

                    taskContainer.append(titleOfTask);
                    projectContainer.append(taskContainer);

                    const timer: Timer = new Timer() as Timer;
                    timer.TimerButton(taskContainer, element, titleOfTask, allProjectArray);

                })
            }
        })


    }
}