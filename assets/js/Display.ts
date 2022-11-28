import {Project} from "./Project";

export class Display {

    public displayProjectFromLocalStorage() {

        let allProjectsString: string = localStorage.getItem("Projects") as string;
        let allProjectArray = JSON.parse(allProjectsString);

        let allProjectsContainer: HTMLDivElement = document.querySelector(".projects_container") as HTMLDivElement;

        allProjectArray.forEach((element: Project) => {

            /**
             * Just display the title from the localStorage Project.
             */

            let projectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            projectContainer.className = "project margin-2";

            let titleProject: HTMLHeadingElement = document.createElement("h2") as HTMLHeadingElement;
            titleProject.innerHTML = element.title;


            /**
             * Create task button
             * TODO// move it to Project.ts ??
             */
            const inputForNameTask = document.createElement("input");

            const addTaskButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
            addTaskButton.innerHTML = "addTask";
            addTaskButton.addEventListener("click", (e: MouseEvent) => {

                const taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
                const titleOfTask: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;
                titleOfTask.innerHTML = inputForNameTask.value;

                element.tasks = [inputForNameTask.value];

                taskContainer.append(titleOfTask);
                projectContainer.append(taskContainer);

                console.log(allProjectArray);
                localStorage.setItem("Projects", JSON.stringify(allProjectArray));
            })

            projectContainer.append(titleProject);
            projectContainer.append(inputForNameTask);
            projectContainer.append(addTaskButton);
            allProjectsContainer.prepend(projectContainer);

        })




    }
}