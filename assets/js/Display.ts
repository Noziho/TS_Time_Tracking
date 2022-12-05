import {Timer} from "./Timer";
import {Tasks} from "./Tasks";
import {Project} from "./Project";

export class Display {

    public displayProjectFromLocalStorage() {

        /**
         * Get all project from localStorage
         */
        let allProjectsString: string = localStorage.getItem("Projects") as string;
        let allProjectArray = JSON.parse(allProjectsString);

        let allProjectsContainer: HTMLDivElement = document.querySelector(".projects_container") as HTMLDivElement;
        let index: number = 0;

        allProjectArray?.forEach((element: any) => {
            index++;


            let projectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            projectContainer.className = "project padding-1 margin-2";

            /**
             * Set the last interaction with the project.
             */
            projectContainer.addEventListener("click", (e: MouseEvent) => {
                let date = new Date();
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();
                element.lastInteraction = `${day}/${month}/${year}`;
                localStorage.setItem("Projects", JSON.stringify(allProjectArray));
            })

            /**
             * Display the title project from the localStorage.
             */

            let titleProject: HTMLHeadingElement = document.createElement("h2") as HTMLHeadingElement;
            if (typeof element.title === "string") {
                titleProject.innerHTML = element.title;
            }

            projectContainer.append(titleProject);

            /**
             * Display deletion button and add task button
             */

            let functionalityContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            functionalityContainer.className = "functionalityContainer padding-1 margin-top-1";


            let deletionButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
            deletionButton.innerHTML = "Delete project"

            deletionButton.addEventListener("click", (e: MouseEvent) => {
                allProjectArray.splice(index - 1, 1);
                localStorage.setItem("Projects", JSON.stringify(allProjectArray));
                projectContainer.remove();
                location.reload();
            })


            functionalityContainer.append(deletionButton);

            /**
             * Display add task button.
             */
            let allTasksContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            allTasksContainer.className = "allTasksContainer";

            const inputForNameTask = document.createElement("input");

            const addTaskButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
            addTaskButton.innerHTML = "addTask";

            /**
             * Make a new task
             */

            let task = new Tasks();
            task.createTask(allProjectArray, element, functionalityContainer, inputForNameTask, addTaskButton, projectContainer, allTasksContainer);


            /**
             * Display time details and details project button.
             */
            let timeDetailsContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            timeDetailsContainer.className = "timeDetails";

            let timeDetails: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
            timeDetails.innerHTML = element.lastInteraction;

            let seeDetailsButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
            seeDetailsButton.innerHTML = "Voir details";

            seeDetailsButton.addEventListener("click", () => {
                localStorage.setItem("currentProject", JSON.stringify(allProjectArray.indexOf(element)));
                location.assign('http://localhost:8080/projectDetails.html');
            })


            let totalTimeArray: number [] = [];
            element.tasks.forEach((e: Tasks) => {
                totalTimeArray.push(e.totalTime);
            })

            let totalTimeProject = totalTimeArray.reduce((a, b) => a + b, 0);

            let dateObj = new Date(totalTimeProject * 1000);
            let hours = dateObj.getUTCHours();
            let minutes = dateObj.getUTCMinutes();
            let seconds = dateObj.getSeconds();

            let totalTimeContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            totalTimeContainer.className = "totalTimeContainer padding-1";

            let totalTimeText: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
            totalTimeText.innerHTML = `Total: ${hours} h ${minutes} et ${seconds}s`;

            totalTimeContainer.append(totalTimeText);
            timeDetailsContainer.append(totalTimeContainer);
            timeDetailsContainer.append(timeDetails);
            timeDetailsContainer.append(seeDetailsButton);
            projectContainer.append(timeDetailsContainer);

            /**
             * Display all task from all project when the page is loading.
             */


            if (element.tasks) {
                if (element.title === null) {
                    projectContainer.remove();
                }
                let id = 0;
                element.tasks.forEach((e: any) => {
                    id++;
                    const taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
                    taskContainer.className = "task padding-1 margin-top-1";

                    const titleOfTask: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
                    titleOfTask.innerHTML = e.title;

                    taskContainer.append(titleOfTask);
                    allTasksContainer.append(taskContainer);
                    projectContainer.append(allTasksContainer);

                    const timer: Timer = new Timer() as Timer;
                    timer.TimerButton(taskContainer, element, titleOfTask, allProjectArray, id);

                })
            }
            projectContainer.append(functionalityContainer);
            allProjectsContainer?.prepend(projectContainer);
        })


    }

    public displayProjectDetails() {

        const seeDetailsContainer: HTMLDivElement = document.querySelector(".details_project_container") as HTMLDivElement;
        if (seeDetailsContainer) {
            let allProjectsString: string = localStorage.getItem("Projects") as string;
            let allProjectArray = JSON.parse(allProjectsString);


            let index = JSON.parse(localStorage.getItem("currentProject") as string);
            let currentProject: Project = allProjectArray[index] as Project;


            let detailsProjectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            detailsProjectContainer.className = "containerDetailsProject";
            let projectTitle: HTMLHeadingElement = document.createElement("h1") as HTMLHeadingElement;
            projectTitle.innerHTML = currentProject.title ? currentProject.title : "";

            let tasksContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            tasksContainer.className = "detailsTaskContainer";

            currentProject.tasks?.forEach((e: any) => {
                let taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
                taskContainer.className = "detailsList";

                let taskTitle: HTMLHeadingElement = document.createElement("h3") as HTMLHeadingElement;
                taskTitle.innerHTML = e.title;

                let taskTime: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
                taskTime.innerHTML = e.totalTime;

                taskContainer.append(taskTitle);
                taskContainer.append(taskTime);
                tasksContainer.append(taskContainer);

            })



            detailsProjectContainer.append(projectTitle);
            detailsProjectContainer.append(tasksContainer);
            seeDetailsContainer.append(detailsProjectContainer);
        }

    }
}