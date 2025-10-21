/**
 * Client-side HTML/JavaScript validation
 * Provides immediate feedback to users before form submission
 */

(function() {
    'use strict';

    // HTML/JS detection patterns
    const patterns = {
        htmlTags: /<[^>]*>/g,
        scriptTags: /<script\b[^>]*>[\s\S]*?<\/script>/gi,
        styleTags: /<style\b[^>]*>[\s\S]*?<\/style>/gi,
        iframeTags: /<iframe\b[^>]*>[\s\S]*?<\/iframe>/gi,
        objectTags: /<object\b[^>]*>[\s\S]*?<\/object>/gi,
        embedTags: /<embed\b[^>]*>/gi,
        appletTags: /<applet\b[^>]*>[\s\S]*?<\/applet>/gi,
        javascriptProtocol: /\bjavascript\s*:/gi,
        vbscriptProtocol: /\bvbscript\s*:/gi,
        dataProtocol: /\bdata\s*:[^,]*,?/gi,
        eventHandlers: /on[a-zA-Z]+\s*=\s*(\"[^\"]*\"|\'[^\']*\'|[^\s>]+)/gi,
        cssExpressions: /expression\s*\(/gi,
        dangerousChars: /[;&|`$(){}[\]]/g,
        sqlPatterns: /(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\bcreate\b|\balter\b)\s+/gi,
        controlChars: /[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/g
    };

    // Error messages
    const messages = {
        htmlTags: 'HTML tags are not allowed.',
        scriptTags: 'JavaScript code is not allowed.',
        styleTags: 'CSS code is not allowed.',
        iframeTags: 'Iframe tags are not allowed.',
        objectTags: 'Object tags are not allowed.',
        embedTags: 'Embed tags are not allowed.',
        appletTags: 'Applet tags are not allowed.',
        javascriptProtocol: 'JavaScript protocols are not allowed.',
        vbscriptProtocol: 'VBScript protocols are not allowed.',
        dataProtocol: 'Data URLs are not allowed.',
        eventHandlers: 'Event handlers are not allowed.',
        cssExpressions: 'CSS expressions are not allowed.',
        dangerousChars: 'Potentially dangerous characters are not allowed.',
        sqlPatterns: 'SQL injection patterns are not allowed.',
        controlChars: 'Invalid characters are not allowed.'
    };

    /**
     * Check if input contains HTML or JavaScript
     */
    function containsHtmlOrScript(value) {
        if (!value || typeof value !== 'string') {
            return { isValid: true };
        }

        for (const [patternName, pattern] of Object.entries(patterns)) {
            if (pattern.test(value)) {
                return {
                    isValid: false,
                    message: messages[patternName],
                    pattern: patternName
                };
            }
        }

        return { isValid: true };
    }

    /**
     * Add validation to form fields
     */
    function addValidationToFields() {
        // Get all text inputs, textareas, and contenteditable elements
        const fields = document.querySelectorAll('input[type="text"], input[type="email"], textarea, [contenteditable="true"]');
        
        fields.forEach(field => {
            // Skip if already has validation
            if (field.dataset.htmlValidated) {
                return;
            }

            field.dataset.htmlValidated = 'true';
            
            // Create error message element
            const errorElement = document.createElement('div');
            errorElement.className = 'html-validation-error text-danger small mt-1';
            errorElement.style.display = 'none';
            field.parentNode.insertBefore(errorElement, field.nextSibling);

            // Add event listeners
            field.addEventListener('input', function() {
                validateField(this, errorElement);
            });

            field.addEventListener('blur', function() {
                validateField(this, errorElement);
            });

            field.addEventListener('paste', function(e) {
                // Delay validation to allow paste to complete
                setTimeout(() => {
                    validateField(this, errorElement);
                }, 10);
            });
        });
    }

    /**
     * Validate a single field
     */
    function validateField(field, errorElement) {
        const value = field.value || field.textContent || '';
        const result = containsHtmlOrScript(value);

        if (!result.isValid) {
            errorElement.textContent = result.message;
            errorElement.style.display = 'block';
            field.classList.add('is-invalid');
            
            // Prevent form submission
            const form = field.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    return false;
                });
            }
        } else {
            errorElement.style.display = 'none';
            field.classList.remove('is-invalid');
        }
    }

    /**
     * Validate all fields in a form
     */
    function validateForm(form) {
        const fields = form.querySelectorAll('input[type="text"], input[type="email"], textarea, [contenteditable="true"]');
        let isValid = true;

        fields.forEach(field => {
            const value = field.value || field.textContent || '';
            const result = containsHtmlOrScript(value);

            if (!result.isValid) {
                const errorElement = field.parentNode.querySelector('.html-validation-error');
                if (errorElement) {
                    errorElement.textContent = result.message;
                    errorElement.style.display = 'block';
                }
                field.classList.add('is-invalid');
                isValid = false;
            }
        });

        return isValid;
    }

    /**
     * Initialize validation
     */
    function init() {
        // Add validation to existing fields
        addValidationToFields();

        // Watch for dynamically added fields
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    addValidationToFields();
                }
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });

        // Add form submission validation
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.tagName === 'FORM') {
                if (!validateForm(form)) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose functions globally for manual use
    window.HtmlValidation = {
        validate: containsHtmlOrScript,
        validateField: validateField,
        validateForm: validateForm,
        addValidationToFields: addValidationToFields
    };

})();
