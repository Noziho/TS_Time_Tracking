export class Tasks {

    public taskButton (projectContainer: HTMLDivElement): HTMLButtonElement{


        const addTaskButton: HTMLButtonElement = document.createElement("button") as HTMLButtonElement;
        addTaskButton.innerHTML = "addTask";
        addTaskButton.addEventListener("click", (e: MouseEvent) => {
            const taskContainer: HTMLDivElement = document.createElement("div") as HTMLDivElement;

            const titleOfTask: HTMLParagraphElement = document.createElement("p") as HTMLParagraphElement;

            titleOfTask.innerHTML = "Ma task test";

            taskContainer.append(titleOfTask);

            projectContainer.append(taskContainer);
            console.log("Test");
        })

        return addTaskButton;

    }

}