import { useEffect, useState } from "react";
import Task, { TaskProps } from "@/Components/Tasks/Task";
import CreateTask from "@/Components/Tasks/Features/Create.Task";

function Tasks() {
    const [tasks, setTasks] = useState<TaskProps[] | []>([]);

    //get all task
    function retrieveTasks() {
        fetch("https://jsonplaceholder.typicode.com/todos/1")
            .then((response) => response.json())
            .then((parsedResponse) => setTasks([parsedResponse]))
            .catch((err) => alert(err));
    }

    useEffect(() => {
        retrieveTasks();
    }, []);

    return (
        <div className="tw-w-full tw-flex tw-flex-col tw-gap-4 tw-bg-slate-100 tw-p-4 tw-rounded-lg">
            <section className="tw-flex tw-justify-between tw-h-fit tw-items-center">
                <h1 className="tw-text-lg">
                    <span>Upcoming tasks.</span>
                    <span className="tw-text-sm">{` (${tasks.length})`}</span>
                </h1>
                <CreateTask />
            </section>
            <section className="tw-flex tw-flex-col tw-gap-4 tw-p-6 tw-h-[400px] tw-overflow-auto tw-items-center">
                {tasks.length > 0 ? (
                    tasks.map(({ id, title, completed }) => {
                        return (
                            <Task
                                title={title}
                                description={
                                    "Nullam mauris enim, porta sit amet porttitor vitae, fermentum non mi. Nunc rhoncus id risus vitae euismod. Vivamus porta orci augue, sollicitudin congue eros molestie vel. Aliquam blandit nunc et luctus finibus. Proin vel turpis eget odio dapibus convallis. Vivamus interdum nunc nec ultrices ultricies. Ut commodo est orci."
                                }
                                start_at={"10:54 AM"}
                                end_at={"02:00 PM"}
                                completed={completed}
                                key={id}
                                id={id}
                            />
                        );
                    })
                ) : (
                    <h1>Good job all done with the tasks.</h1>
                )}
            </section>
        </div>
    );
}

export default Tasks;
