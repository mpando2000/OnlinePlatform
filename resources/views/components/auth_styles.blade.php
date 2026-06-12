<style>
    body,
    .wrapper {
        background: #f7f9fc !important;
        color: #111827;
        font-family: "Source Sans Pro", Arial, sans-serif;
    }

    .wrapper > .container {
        max-width: none;
        width: 100%;
        padding: 0;
    }

    .auth-page {
        align-items: center;
        background: #f7f9fc;
        display: flex;
        justify-content: center;
        min-height: 100vh;
        padding: 44px 18px;
    }

    .auth-shell {
        max-width: 480px;
        width: 100%;
    }

    .auth-shell.auth-shell-wide {
        max-width: 840px;
    }

    .auth-brand {
        text-align: center;
        margin-bottom: 26px;
    }

    .auth-logo {
        background: #e8f4ed;
        border-radius: 50%;
        height: 58px;
        margin-bottom: 18px;
        object-fit: contain;
        padding: 7px;
        width: 58px;
    }

    .auth-brand h1 {
        color: #0f172a;
        font-size: 31px;
        font-weight: 900;
        letter-spacing: 0;
        line-height: 1.15;
        margin: 0 0 8px;
    }

    .auth-brand p {
        color: #53606c;
        font-size: 16px;
        margin: 0;
    }

    .auth-card {
        background: #fff;
        border: 1px solid #e5eaf0;
        border-radius: 8px;
        box-shadow: 0 18px 46px rgba(15, 23, 42, 0.08);
        padding: 28px;
    }

    .auth-grid {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .auth-grid.auth-grid-two {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .auth-field {
        margin-bottom: 18px;
    }

    .auth-field label,
    .auth-row-label {
        color: #111827;
        display: block;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .auth-input-wrap {
        position: relative;
    }

    .auth-field input,
    .auth-field select {
        background: #fff;
        border: 1px solid #d9e0e8;
        border-radius: 8px;
        color: #111827;
        height: 48px;
        padding: 11px 13px;
        width: 100%;
    }

    .auth-field input:focus,
    .auth-field select:focus {
        border-color: #68a83d;
        box-shadow: 0 0 0 3px rgba(104, 168, 61, 0.14);
        outline: none;
    }

    .auth-password input {
        padding-right: 46px;
    }

    .auth-eye {
        align-items: center;
        background: transparent;
        border: 0;
        bottom: 5px;
        color: #5f6b77;
        display: flex;
        height: 38px;
        justify-content: center;
        position: absolute;
        right: 5px;
        width: 38px;
    }

    .auth-options {
        align-items: center;
        display: flex;
        justify-content: space-between;
        gap: 14px;
        margin: -2px 0 20px;
    }

    .auth-check {
        align-items: center;
        color: #3d4852;
        display: inline-flex;
        gap: 9px;
        margin: 0;
    }

    .auth-check input {
        height: 18px;
        width: 18px;
    }

    .auth-link {
        color: #314155;
        font-weight: 800;
        text-decoration: none;
    }

    .auth-link:hover {
        color: #4f8f2e;
        text-decoration: none;
    }

    .auth-btn {
        align-items: center;
        background: #66a83f;
        border: 0;
        border-radius: 8px;
        color: #fff;
        display: inline-flex;
        font-weight: 900;
        gap: 8px;
        height: 48px;
        justify-content: center;
        padding: 10px 18px;
        text-decoration: none;
        width: 100%;
    }

    .auth-btn:hover {
        background: #548f34;
        color: #fff;
        text-decoration: none;
    }

    .auth-divider {
        align-items: center;
        color: #6b7280;
        display: flex;
        gap: 16px;
        margin: 24px 0;
    }

    .auth-divider::before,
    .auth-divider::after {
        background: #e2e8f0;
        content: "";
        flex: 1;
        height: 1px;
    }

    .auth-footer-link {
        color: #3d4852;
        margin-top: 24px;
        text-align: center;
    }

    .auth-footer-link a {
        color: #111827;
        font-weight: 900;
    }

    .auth-home {
        margin-top: 18px;
        text-align: center;
    }

    .auth-alert {
        border-radius: 8px;
        font-weight: 700;
        margin-bottom: 18px;
        padding: 12px 14px;
    }

    .auth-alert-success {
        background: #edf9ef;
        border: 1px solid #b9e6c0;
        color: #176a2c;
    }

    .auth-error {
        background: #fff1f2;
        border-left: 3px solid #e11d48;
        border-radius: 6px;
        color: #be123c;
        display: block;
        font-size: 13px;
        margin-top: 7px;
        padding: 7px 9px;
    }

    @media (max-width: 768px) {
        .auth-page {
            align-items: flex-start;
            padding-top: 28px;
        }

        .auth-card {
            padding: 22px;
        }

        .auth-grid,
        .auth-grid.auth-grid-two {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .auth-options {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
