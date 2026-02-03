const getEditorConfig = () => {
    const isDarkMode = document.documentElement.classList.contains("dark");
    return {
        selector: "textarea.editor",
        setup: function (editor) {
            editor.on("change", function () {
                editor.save();
            });
        },
        plugins:
            "preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen link template table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",
        menubar: "file edit view insert format tools table help",
        toolbar:
            "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview print | template link anchor | ltr rtl",
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        importcss_append: true,
        height: 600,
        quickbars_selection_toolbar:
            "bold italic | quicklink h2 h3 blockquote quickimage",
        quickbars_insert_toolbar: false,
        noneditable_class: "mceNonEditable",
        toolbar_mode: "sliding",
        contextmenu: "link table",
        skin: isDarkMode ? "oxide-dark" : "oxide",
        content_css: isDarkMode ? "dark" : "default",
        content_style:
            "@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap'); body { font-family:'Plus Jakarta Sans',Helvetica,Arial,sans-serif; font-size:16px; color: " +
            (isDarkMode ? "#cbd5e1" : "#334155") +
            "; background-color: " +
            (isDarkMode ? "#1e293b" : "#ffffff") +
            "; } h1,h2,h3,h4,h5,h6 { color: " +
            (isDarkMode ? "#f8fafc" : "#1e293b") +
            "; }",
    };
};

const initEditor = () => {
    tinymce.remove("textarea.editor");
    tinymce.init(getEditorConfig());
};

// Initial init
initEditor();

// Watch for dark mode changes
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (
            mutation.type === "attributes" &&
            mutation.attributeName === "class"
        ) {
            initEditor();
        }
    });
});

observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ["class"],
});
