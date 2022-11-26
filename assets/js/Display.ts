import {Project} from "./Project";

export class Display {

    public displayProjectFromLocalStorage () {
        //Get all project from local storage.
        if (localStorage.getItem("Projects")) {
            let stringProjects: string = localStorage.getItem("Projects") as string;
            let arrayProjects: Project[] = JSON.parse(stringProjects);

            let projectContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;


            arrayProjects.forEach((element: Project) => {


                console.log("Test");










            })
        }


    }
}