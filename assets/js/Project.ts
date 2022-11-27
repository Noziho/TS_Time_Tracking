import * as process from "process";
import {Display} from "./Display";

export class Project {

    private allProjects: Project[] = [];
    public title:string = "";

    public createProject ():void {

        let inputContainer: HTMLDivElement = document.querySelector('.createProjectContainer') as HTMLDivElement;

        let buttonAddProject: HTMLButtonElement = document.createElement("button")as  HTMLButtonElement;
        buttonAddProject.innerHTML = "Add project";

        buttonAddProject.addEventListener("click", (e: MouseEvent) => {
            let inputForTitle: HTMLInputElement = document.querySelector("input") as HTMLInputElement;

            if (localStorage.getItem("Projects")) {
                let allProjectsString: string = localStorage.getItem("Projects") as string;
                console.log(typeof allProjectsString);
                let allProjectArray = JSON.parse(allProjectsString);

                let project: Project = new Project();
                project.title = inputForTitle.value;

                allProjectArray.push(project);

                localStorage.setItem("Projects", JSON.stringify(allProjectArray));
                inputForTitle.value = "";

                console.log(localStorage);
            }
            else {

                let project: Project = new Project();
                project.title = inputForTitle.value;

                this.allProjects.push(project);

                localStorage.setItem("Projects", JSON.stringify(this.allProjects));
                inputForTitle.value = "";

                console.log(localStorage);
            }
        })

        inputContainer.append(buttonAddProject);

    }


}