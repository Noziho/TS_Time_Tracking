import {Project} from "./Project";
import {Tasks} from "./Tasks";

export class Display {

    public displayProjectFromLocalStorage() {

        let allProjectsString: string = localStorage.getItem("Projects") as string;
        let allProjectArray = JSON.parse(allProjectsString);

        let allProjectsContainer: HTMLDivElement = document.querySelector(".projects_container") as HTMLDivElement;

        allProjectArray.forEach((element: Project) => {

            let projectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
            projectContainer.className = "project margin-2";

            let titleProject: HTMLHeadingElement = document.createElement("h2") as HTMLHeadingElement;
            titleProject.innerHTML = element.title;

            projectContainer.append(titleProject);
            projectContainer.append(new Tasks().taskButton(projectContainer));

            allProjectsContainer.prepend(projectContainer);

        })


    }
}