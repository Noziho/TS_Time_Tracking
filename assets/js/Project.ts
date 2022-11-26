import * as process from "process";

export class Project {

    private allProjects: Project[] = [];
    private title:string = "";

    public createProject ():void {

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

                console.log(localStorage);
            }
            else {

                let project: Project = new Project();
                project.title = inputForTitle.value;

                this.allProjects.push(project);

                localStorage.setItem("Projects", JSON.stringify(this.allProjects));

                console.log(localStorage);
            }
        })

        document.body.append(buttonAddProject);

    }


}