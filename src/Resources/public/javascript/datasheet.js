class Datasheet {

    constructor(datasheet) {
        this.datasheet = {
            container: datasheet,
            id: datasheet.getAttribute('data-datasheet'),
            form: datasheet.querySelector('[data-datasheet-form]'),
            queryKey: {
                datasheetFilters: datasheet.getAttribute('data-datasheet-filters-key'),
            }
        };
        this.readPagination();
        this.buildPagination();
    }

    readPagination() {
        this.paginationContainer = this.datasheet.container.querySelectorAll('[data-datasheet-pagination]')[0];
        this.pagination = {
            recordsTotal: parseInt(this.paginationContainer.getAttribute('data-datasheet-pagination-records-total')),
            recordsPerPage: parseInt(this.paginationContainer.getAttribute('data-datasheet-pagination-records-per-page')),
            pagesTotal: parseInt(this.paginationContainer.getAttribute('data-datasheet-pagination-pages-total')),
            currentPage: parseInt(this.paginationContainer.getAttribute('data-datasheet-pagination-current-page')),
        }
        console.log({'pagination': this.pagination});
    }

    buildPagination() {
        const paginationMaxButtons = 10;
        let currentPage = this.pagination.currentPage,
            pagesTotal = this.pagination.pagesTotal,
            pageButtons = Array.from({length: pagesTotal}, (_, i) => i + 1);

        if (pageButtons.length > paginationMaxButtons) {
            const sideLength = paginationMaxButtons / 2;
            const startIndex = Math.max(currentPage - sideLength, 0);
            const endIndex = Math.min(currentPage + sideLength, pageButtons.length - 1);
            pageButtons = pageButtons.slice(startIndex, endIndex + 1);
        }

        if (currentPage !== 1) {
            this.paginationContainer.appendChild(this.datasheetPaginationBuildButton(1, 'First', currentPage));
        }

        pageButtons.forEach((number) => {
            this.paginationContainer.appendChild(this.datasheetPaginationBuildButton(number, number, currentPage));
        });

        if (currentPage !== pagesTotal) {
            this.paginationContainer.appendChild(this.datasheetPaginationBuildButton(pagesTotal, 'Last', currentPage));
        }
    }

    datasheetPaginationBuildButton(number, text, currentPage) {
        const li = document.createElement("li");
        li.className = "page-item" + (currentPage === number ? " active" : "");

        const link = document.createElement("a");
        link.className = "page-link";
        link.href = `#page${number}`;
        link.textContent = text;
        link.dataset.pageNumber = number;

        link.addEventListener("click", (event) => {
            event.preventDefault();
            this.datasheetPaginationChange(event.target);
        });

        li.appendChild(link);

        return li;
    }

    datasheetPaginationChange(paginationElement) {
        let inputName = this.datasheet.id + '[' + [
            this.datasheet.queryKey.datasheetFilters,
            'pgn',
            'currentPage',
        ].join('][') + ']';
        this.datasheet.container.querySelector('[name="' + inputName + '"]').value = paginationElement.dataset.pageNumber;
        this.datasheet.form.submit();
    }
}

console.log('Initializing datasheets…');

document
    .querySelectorAll('[data-datasheet]')
    .forEach(element => new Datasheet(element));