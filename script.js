if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

function init() {
    const items = new ListItems(document.getElementById('list_items'), menuData);

    items.render();
    items.init();

    function ListItems(el, data) {
        this.el = el;
        this.data = data;

        this.init = function () {
            const parents = this.el.querySelectorAll('[data-parent]');

            parents.forEach(parent => {
                const open = parent.querySelector('[data-open]');

                open.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleItems(parent);
                });
            });
        };

        this.render = function () {
            this.el.insertAdjacentHTML('beforeend', this.renderParent(this.data));
        };

        this.renderParent = function (data) {
            if (data.hasChildren) {
                let children = '';
                for (let i = 0; i < data.items.length; i++) {
                    const child = data.items[i];
                    children += this.renderParent(child);
                }
                return `
                    <div class="list_item list_item_open" data-parent>
                        <div class="list_item_inner">
                            <img class="list_item_arrow" src="imgs/chevron-down.png" data-open>
                            <img class="list_item_folder" src="imgs/folder.png">
                            <span>${data.name}</span>
                        </div>
                        <div class="list_item_items">
                            ${children}
                        </div>
                    </div>`;
            }
            else {
                return this.renderChildren(data);
            }
        };
        
        this.renderChildren = function (data) {
            return `
                <div class="list_item_inner list_item_child">
                    <img class="list_item_folder" src="imgs/folder.png">
                    <span>${data.name}</span>
                </div>`;
        };
        
        this.toggleItems = function (parent) {
            parent.classList.toggle('list_item_open');
        };
    }
}