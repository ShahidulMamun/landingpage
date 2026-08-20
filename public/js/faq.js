document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("faqSearchInput");
    const noResults = document.getElementById("faqNoResults");
    if (!input) return;

    input.addEventListener("input", function () {
        const term = this.value.trim().toLowerCase();
        const items = document.querySelectorAll(".faq-item");
        let anyVisible = false;

        items.forEach((item) => {
            const q = item.dataset.question || "";
            const a = item.dataset.answer || "";
            const matches = term === "" || q.includes(term) || a.includes(term);

            item.style.display = matches ? "" : "none";
            if (matches) anyVisible = true;

            // Auto-open the matching item when actively searching
            const collapseEl = item.querySelector(".accordion-collapse");
            const buttonEl = item.querySelector(".accordion-button");
            if (term !== "" && matches && window.bootstrap && collapseEl) {
                new bootstrap.Collapse(collapseEl, { show: true });
                buttonEl.classList.remove("collapsed");
            } else if (term === "" && collapseEl) {
                new bootstrap.Collapse(collapseEl, { hide: true });
            }
        });

        if (noResults) {
            noResults.classList.toggle("d-none", anyVisible || term === "");
        }
    });
});
