import todosService from "../services/todos.js";
import loading from "../services/loading.js";

const renderTodos = (todos) => {
    const todosContainer = document.getElementById('todos');
    todosContainer.innerHTML = '';

    const todoList = document.createElement('ul');
    todoList.id = 'todo-list';
    
    todos.forEach(todo => {
        const todoItem = document.createElement('li');
        todoItem.classList.add('todo-item');
        todoItem.innerHTML = `
            <input type="checkbox" data-id="${todo.id}" ${todo.completed ? 'checked' : ''}>
            <span>${todo.description}</span>
            <button class="delete-button" data-id="${todo.id}">Удалить</button>
        `;
        todoList.appendChild(todoItem);
    });
    
    todosContainer.appendChild(todoList);
};

const init = async () => {
    loading.start();

    try {
        const todos = await todosService.getAll();
        renderTodos(todos);
    } catch (error) { console.error(error); }
    finally { loading.stop(); }

    const todoForm = document.getElementById('todo-form');
    todoForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const input = todoForm.querySelector('input[name="todo"]');
        const description = input.value.trim();

        if (description) {
            loading.start();
            try {
                await todosService.create(description);
                input.value = '';
                const todos = await todosService.getAll();
                renderTodos(todos);
            } catch (error) { console.error(error); }
            finally { loading.stop(); }
        }
    });

    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-button')) {
            const todoId = e.target.dataset.id;
            loading.start();
            try {
                await todosService.delete(todoId);
                const todos = await todosService.getAll();
                renderTodos(todos);
            } catch (error) { console.error(error); }
            finally { loading.stop(); }
        }
    });

    document.addEventListener('change', async (e) => {
        if (e.target.type === 'checkbox' && e.target.closest('#todos')) {
            const todoId = e.target.dataset.id;
            const completed = e.target.checked;
            loading.start();
            try {
                await todosService.updateStatus(todoId, completed);
                const todos = await todosService.getAll();
                renderTodos(todos);
            } catch (error) { console.error(error); }
            finally { loading.stop(); }
        }
    });

    const refreshButton = document.getElementById('todos_button');
    refreshButton.addEventListener('click', async () => {
        loading.start();
        try {
            const todos = await todosService.getAll();
            renderTodos(todos);
        } catch (error) { console.error(error); }
        finally { loading.stop(); }
    });

    const deleteButton = document.getElementById('delete_button');
    deleteButton.addEventListener('click', async () => {
        loading.start();
        try {
            const checkboxes = document.querySelectorAll('#todos input[type="checkbox"]:checked');
            for (const checkbox of checkboxes) {
                await todosService.delete(checkbox.dataset.id);
            }
            const todos = await todosService.getAll();
            renderTodos(todos);
        } catch (error) { console.error(error); }
        finally { loading.stop(); }
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}