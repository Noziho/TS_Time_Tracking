import {Tasks} from "./Tasks";

export class Project {

    private allProjects: Project[] = [];
    public tasks : Tasks [] | null = [];
    public title:string | null = "";
    public lastInteraction: string = "";

    public createButtonProject ():void {

        let inputContainer: HTMLDivElement = document.querySelector('.createProjectContainer') as HTMLDivElement;

        let buttonAddProject: HTMLButtonElement = document.createElement("button")as  HTMLButtonElement;
        buttonAddProject.innerHTML = "Add project";

        /**
         * Make a new project when clicked.
         */
        buttonAddProject.addEventListener("click", (e: MouseEvent) => {
            let inputForTitle: HTMLInputElement = document.querySelector("input") as HTMLInputElement;

            /**
             * Get projects from localStorage if exists.
             */
            if (localStorage.getItem("Projects")) {

                let allProjectsString: string = localStorage.getItem("Projects") as string;
                let allProjectArray = JSON.parse(allProjectsString);

                let project: Project = new Project();
                project.title = inputForTitle.value;

                allProjectArray.push(project);

                localStorage.setItem("Projects", JSON.stringify(allProjectArray));
                inputForTitle.value = "";

                location.reload();

            }
            else {

                /**
                 * When localStorage "Projects" is empty.
                 */
                let project: Project = new Project();
                project.title = inputForTitle.value;

                this.allProjects.push(project);

                localStorage.setItem("Projects", JSON.stringify(this.allProjects));
                inputForTitle.value = "";

                location.reload();

            }
        })

        inputContainer?.append(buttonAddProject);

    }
}