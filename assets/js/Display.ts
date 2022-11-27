import {Project} from "./Project";

export class Display {

    public displayProjectFromLocalStorage () {

        let allProjectsContainer: HTMLDivElement = document.querySelector(".projects_container") as HTMLDivElement;

        //Get all project from local storage.
        if (localStorage.getItem("Projects")) {
            let stringProjects: string = localStorage.getItem("Projects") as string;
            let arrayProjects: Project[] = JSON.parse(stringProjects);


            arrayProjects.reverse().forEach((element: Project) => {

                let projectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;
                projectContainer.className = "project margin-2";

                let titleProject: HTMLHeadingElement = document.createElement("h2") as HTMLHeadingElement;
                titleProject.innerHTML = element.title;

                projectContainer.append(titleProject);

                allProjectsContainer.append(projectContainer);

            })
        }


    }
}