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

    // ---- Cart module ----
    const cartBtn = document.getElementById("skCartBtn");
    const cartBadge = document.querySelector(".sk-cart-count");
    const cartItemsList = document.getElementById("cartItemsList");
    const cartEmptyState = document.getElementById("cartEmptyState");
    const cartFooter = document.getElementById("cartFooter");
    const cartSubtotalEl = document.getElementById("cartSubtotal");
    const cartCheckoutBtn = document.getElementById("cartCheckoutBtn");
    const cartCheckoutForm = document.getElementById("cartCheckoutForm");
    const cartBackToItems = document.getElementById("cartBackToItems");
    const cartItemsView = document.getElementById("cartItemsView");
    const cartCheckoutSuccess = document.getElementById("cartCheckoutSuccess");
    const cartGrandTotalEl = document.getElementById("cartGrandTotal");
    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    let lastCartSubtotal = 0;

    function csrfHeaders(extra) {
        return Object.assign(
            {
                "X-CSRF-TOKEN": csrfToken ? csrfToken.content : "",
                Accept: "application/json",
            },
            extra || {},
        );
    }

    function fmtMoney(n) {
        return "৳" + new Intl.NumberFormat("en-US").format(n);
    }

    function updateCartBadge(count) {
        if (!cartBadge) return;
        cartBadge.textContent = count;
        cartBadge.classList.toggle("d-none", count === 0);
    }

    function renderCart(data) {
        lastCartSubtotal = data.subtotal || 0;
        updateCartBadge(data.cart_count || 0);

        if (!data.items || data.items.length === 0) {
            cartItemsList.innerHTML = "";
            cartEmptyState.classList.remove("d-none");
            cartFooter.classList.add("d-none");
            return;
        }

        cartEmptyState.classList.add("d-none");
        cartFooter.classList.remove("d-none");
        cartSubtotalEl.textContent = fmtMoney(data.subtotal);

        cartItemsList.innerHTML = data.items
            .map(
                (item) => `
      <div class="sk-cart-item" data-id="${item.product_id}">
        <img src="${item.image || "https://images.unsplash.com/photo-1560769629-975ec94e6a86?q=80&w=200&auto=format&fit=crop"}" alt="${item.name}">
        <div class="sk-cart-item-info">
          <h6>${item.name}</h6>
          <span class="sk-cart-item-price">${fmtMoney(item.price)}</span>
          <div class="sk-cart-qty-stepper">
            <button type="button" class="sk-cart-qty-minus"><i class="bi bi-dash"></i></button>
            <span>${item.quantity}</span>
            <button type="button" class="sk-cart-qty-plus"><i class="bi bi-plus"></i></button>
          </div>
        </div>
        <button type="button" class="sk-cart-item-remove"><i class="bi bi-trash"></i></button>
      </div>
    `,
            )
            .join("");
    }

    function loadCart() {
        fetch(window.SK_CART_INDEX_URL, { headers: csrfHeaders() })
            .then((res) => res.json())
            .then(renderCart)
            .catch(() => {});
    }

    // Add to cart buttons on product cards
    document.querySelectorAll(".sk-add-to-cart").forEach((btn) => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.id;
            const original = this.innerHTML;
            this.disabled = true;
            this.innerHTML =
                '<span class="spinner-border spinner-border-sm"></span>';

            fetch(window.SK_CART_ADD_URL, {
                method: "POST",
                headers: csrfHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ product_id: productId, quantity: 1 }),
            })
                .then((res) => res.json())
                .then((data) => {
                    updateCartBadge(data.cart_count || 0);
                    this.innerHTML =
                        '<i class="bi bi-check-lg"></i> যোগ হয়েছে';
                    setTimeout(() => {
                        this.innerHTML = original;
                        this.disabled = false;
                    }, 1200);
                })
                .catch(() => {
                    this.innerHTML = original;
                    this.disabled = false;
                });
        });
    });

    // Load cart contents each time the offcanvas opens
    const cartOffcanvasEl = document.getElementById("skCartOffcanvas");
    if (cartOffcanvasEl) {
        cartOffcanvasEl.addEventListener("show.bs.offcanvas", function () {
            cartCheckoutForm.classList.add("d-none");
            cartCheckoutSuccess.classList.add("d-none");
            cartItemsView.classList.remove("d-none");
            cartFooter.classList.remove("d-none");
            loadCart();
        });
    }

    // Quantity +/- and remove (event delegation, since items render dynamically)
    if (cartItemsList) {
        cartItemsList.addEventListener("click", function (e) {
            const row = e.target.closest(".sk-cart-item");
            if (!row) return;
            const productId = row.dataset.id;

            if (e.target.closest(".sk-cart-item-remove")) {
                fetch(window.SK_CART_REMOVE_URL, {
                    method: "POST",
                    headers: csrfHeaders({
                        "Content-Type": "application/json",
                    }),
                    body: JSON.stringify({ product_id: productId }),
                })
                    .then((res) => res.json())
                    .then(renderCart);
                return;
            }

            const qtySpan = row.querySelector(".sk-cart-qty-stepper span");
            let qty = parseInt(qtySpan.textContent, 10);

            if (e.target.closest(".sk-cart-qty-plus")) {
                qty++;
            } else if (e.target.closest(".sk-cart-qty-minus")) {
                qty = Math.max(1, qty - 1);
            } else {
                return; // ক্লিক করা এলিমেন্টটা +/- বা remove কোনোটাই না, কিছু করার দরকার নেই
            }

            fetch(window.SK_CART_UPDATE_URL, {
                method: "POST",
                headers: csrfHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ product_id: productId, quantity: qty }),
            })
                .then((res) => res.json())
                .then(renderCart);
        });
    }

    // Show checkout form
    if (cartCheckoutBtn) {
        cartCheckoutBtn.addEventListener("click", function () {
            cartItemsView.classList.add("d-none");
            cartFooter.classList.add("d-none");
            cartCheckoutForm.classList.remove("d-none");
            updateCartGrandTotal();
        });
    }

    if (cartBackToItems) {
        cartBackToItems.addEventListener("click", function () {
            cartCheckoutForm.classList.add("d-none");
            cartItemsView.classList.remove("d-none");
            cartFooter.classList.remove("d-none");
        });
    }

    function updateCartGrandTotal() {
        const checked = cartCheckoutForm.querySelector(
            'input[name="delivery_area"]:checked',
        );
        const deliveryCharge = checked
            ? parseInt(checked.dataset.charge, 10)
            : 0;
        cartGrandTotalEl.textContent = fmtMoney(
            lastCartSubtotal + deliveryCharge,
        );
    }

    if (cartCheckoutForm) {
        cartCheckoutForm
            .querySelectorAll('input[name="delivery_area"]')
            .forEach((el) => {
                el.addEventListener("change", updateCartGrandTotal);
            });

        cartCheckoutForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const submitBtn = cartCheckoutForm.querySelector(
                'button[type="submit"]',
            );
            const btnText = submitBtn.querySelector(".cart-checkout-btn-text");
            const btnSpinner = submitBtn.querySelector(
                ".cart-checkout-btn-spinner",
            );
            const errorBox = cartCheckoutForm.querySelector(
                ".cart-checkout-error",
            );

            btnText.classList.add("d-none");
            btnSpinner.classList.remove("d-none");
            submitBtn.disabled = true;
            errorBox.classList.add("d-none");

            const formData = new FormData(cartCheckoutForm);

            fetch(window.SK_CART_CHECKOUT_URL, {
                method: "POST",
                headers: csrfHeaders(),
                body: formData,
            })
                .then((res) => {
                    if (!res.ok) throw new Error("validation-or-server-error");
                    return res.json();
                })
                .then(() => {
                    cartCheckoutForm.classList.add("d-none");
                    cartCheckoutSuccess.classList.remove("d-none");
                    updateCartBadge(0);
                })
                .catch(() => {
                    errorBox.textContent =
                        "দুঃখিত, অর্ডার সাবমিট করা যায়নি। আবার চেষ্টা করো।";
                    errorBox.classList.remove("d-none");
                })
                .finally(() => {
                    btnText.classList.remove("d-none");
                    btnSpinner.classList.add("d-none");
                    submitBtn.disabled = false;
                });
        });
    }

    // পেজ লোড হওয়ার সাথে সাথে badge count রিফ্রেশ করা (আগের সেশনে কার্টে কিছু থাকলে দেখাবে)
    loadCart();
});
