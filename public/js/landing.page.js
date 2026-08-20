document.addEventListener("DOMContentLoaded", function () {
    // ---- Scroll reveal ----
    const revealEls = document.querySelectorAll("[data-reveal]");

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const delay =
                            entry.target.getAttribute("data-reveal-delay") || 0;
                        setTimeout(
                            () => entry.target.classList.add("sk-visible"),
                            delay,
                        );
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 },
        );

        revealEls.forEach((el) => observer.observe(el));
    } else {
        // Fallback: no IntersectionObserver support
        revealEls.forEach((el) => el.classList.add("sk-visible"));
    }

    // ---- Sticky navbar shadow on scroll ----
    const navbar = document.querySelector(".sk-navbar");
    if (navbar) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 12) {
                navbar.style.boxShadow = "0 8px 24px rgba(15,82,87,0.08)";
            } else {
                navbar.style.boxShadow = "none";
            }
        });
    }

    // ---- Product details + quick order modal ----
    const orderModalEl = document.getElementById("orderModal");
    if (orderModalEl && window.bootstrap) {
        const orderModal = new bootstrap.Modal(orderModalEl);
        const form = document.getElementById("omOrderForm");
        const successView = document.querySelector(".sk-order-success");
        const bodyView = document.querySelector(".sk-order-body");
        let currentPrice = 0;
        let qty = 1;

        function fmt(n) {
            return "৳" + new Intl.NumberFormat("en-US").format(n);
        }

        function updateTotal() {
            document.getElementById("omQtyValue").textContent = qty;
            document.getElementById("omQtyField").value = qty;
            document.getElementById("omTotalPrice").textContent = fmt(
                currentPrice * qty,
            );
        }

        function openModalFromCard(card) {
            const name = card.dataset.name;
            const price = parseInt(card.dataset.price, 10) || 0;
            const old =
                card.dataset.old && card.dataset.old !== ""
                    ? parseInt(card.dataset.old, 10)
                    : null;

            currentPrice = price;
            qty = 1;

            document.getElementById("omProductImg").src = card.dataset.img;
            document.getElementById("omProductImg").alt = name;
            document.getElementById("omProductName").textContent = name;
            document.getElementById("omProductDesc").textContent =
                card.dataset.desc || "";
            document.getElementById("omProductPrice").textContent = fmt(price);
            document.getElementById("omProductOld").textContent = old
                ? fmt(old)
                : "";
            document.getElementById("omProductId").value = card.dataset.id;
            document.getElementById("omProductNameField").value = name;
            document.getElementById("omUnitPrice").value = price;

            updateTotal();
            successView.classList.add("d-none");
            bodyView.classList.remove("d-none");
            form.reset();
            // reset() clears hidden fields too — restore them
            document.getElementById("omProductId").value = card.dataset.id;
            document.getElementById("omProductNameField").value = name;
            document.getElementById("omUnitPrice").value = price;
            updateTotal();
            orderModal.show();
        }

        document
            .querySelectorAll(".sk-open-details, .sk-open-order")
            .forEach((el) => {
                el.addEventListener("click", function () {
                    const card = this.closest(".sk-product-card");
                    if (card) openModalFromCard(card);
                });
            });

        document.getElementById("omQtyMinus").addEventListener("click", () => {
            if (qty > 1) {
                qty--;
                updateTotal();
            }
        });
        document.getElementById("omQtyPlus").addEventListener("click", () => {
            qty++;
            updateTotal();
        });

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector(".sk-btn-text");
            const btnSpinner = submitBtn.querySelector(".sk-btn-spinner");
            const errorBox = form.querySelector(".sk-order-error");

            btnText.classList.add("d-none");
            btnSpinner.classList.remove("d-none");
            submitBtn.disabled = true;
            errorBox.classList.add("d-none");

            const token = document.querySelector('meta[name="csrf-token"]');
            const formData = new FormData(form);

            // এই fetch টা routes/web.php তে যোগ করা POST /order রুটে পাঠাবে
            // (route-add-to-web.php ফাইলে দেওয়া আছে) — OrderController@store হ্যান্ডেল করবে
            // URL টা landing.blade.php থেকে window.SK_ORDER_URL হিসেবে পাস করা হয়েছে
            fetch(window.SK_ORDER_URL, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token ? token.content : "",
                    Accept: "application/json",
                },
                body: formData,
            })
                .then((res) => {
                    if (!res.ok) throw new Error("validation-or-server-error");
                    return res.json();
                })
                .then(() => {
                    bodyView.classList.add("d-none");
                    successView.classList.remove("d-none");
                })
                .catch(() => {
                    errorBox.textContent =
                        "দুঃখিত, অর্ডার সাবমিট করা যায়নি। আবার চেষ্টা করুন বা কল করুন।";
                    errorBox.classList.remove("d-none");
                })
                .finally(() => {
                    btnText.classList.remove("d-none");
                    btnSpinner.classList.add("d-none");
                    submitBtn.disabled = false;
                });
        });

        orderModalEl.addEventListener("hidden.bs.modal", () => {
            form.reset();
            successView.classList.add("d-none");
            bodyView.classList.remove("d-none");
        });
    }

    // ---- Newsletter subscribe (real AJAX call to NewsletterController@store) ----
    const newsletterForm = document.getElementById("skNewsletterForm");
    if (newsletterForm) {
        const msgEl = document.querySelector(".sk-newsletter-msg");

        newsletterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const btn = newsletterForm.querySelector("button");
            const emailInput = newsletterForm.querySelector(
                'input[name="email"]',
            );
            const original = btn.textContent;
            const token = document.querySelector('meta[name="csrf-token"]');

            btn.disabled = true;
            btn.textContent = "প্রসেসিং...";

            fetch(window.SK_NEWSLETTER_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token ? token.content : "",
                    Accept: "application/json",
                },
                body: JSON.stringify({ email: emailInput.value }),
            })
                .then((res) =>
                    res.json().then((data) => ({ ok: res.ok, data })),
                )
                .then(({ ok, data }) => {
                    if (msgEl) {
                        msgEl.classList.remove(
                            "d-none",
                            "text-danger",
                            "text-success",
                        );
                        if (ok) {
                            msgEl.classList.add("text-success");
                            msgEl.textContent =
                                data.message || "সাবস্ক্রাইব হয়েছে!";
                            newsletterForm.reset();
                        } else {
                            msgEl.classList.add("text-danger");
                            const firstError = data.errors
                                ? Object.values(data.errors)[0][0]
                                : data.message;
                            msgEl.textContent =
                                firstError ||
                                "কিছু একটা সমস্যা হয়েছে, আবার চেষ্টা করো।";
                        }
                    }
                })
                .catch(() => {
                    if (msgEl) {
                        msgEl.classList.remove("d-none", "text-success");
                        msgEl.classList.add("text-danger");
                        msgEl.textContent =
                            "নেটওয়ার্ক সমস্যা হয়েছে, আবার চেষ্টা করো।";
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.textContent = original;
                });
        });
    }
});
