/**
 * Client-side HTML/JavaScript validation
 * Provides immediate feedback to users before form submission
 */

(function() {
    'use strict';

    // HTML/JS detection patterns - Enhanced for strict validation
    const patterns = {
        htmlTags: /<[^>]*>/g,
        scriptTags: /<script\b[^>]*>[\s\S]*?<\/script>/gi,
        styleTags: /<style\b[^>]*>[\s\S]*?<\/style>/gi,
        iframeTags: /<iframe\b[^>]*>[\s\S]*?<\/iframe>/gi,
        objectTags: /<object\b[^>]*>[\s\S]*?<\/object>/gi,
        embedTags: /<embed\b[^>]*>/gi,
        appletTags: /<applet\b[^>]*>[\s\S]*?<\/applet>/gi,
        formTags: /<form\b[^>]*>[\s\S]*?<\/form>/gi,
        inputTags: /<input\b[^>]*>/gi,
        textareaTags: /<textarea\b[^>]*>[\s\S]*?<\/textarea>/gi,
        selectTags: /<select\b[^>]*>[\s\S]*?<\/select>/gi,
        buttonTags: /<button\b[^>]*>[\s\S]*?<\/button>/gi,
        javascriptProtocol: /\bjavascript\s*:/gi,
        vbscriptProtocol: /\bvbscript\s*:/gi,
        dataProtocol: /\bdata\s*:[^,]*,?/gi,
        eventHandlers: /on[a-zA-Z]+\s*=\s*(\"[^\"]*\"|\'[^\']*\'|[^\s>]+)/gi,
        cssExpressions: /expression\s*\(/gi,
        dangerousChars: /[;&|`$(){}[\]]/g,
        sqlPatterns: /(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\bcreate\b|\balter\b)\s+/gi,
        controlChars: /[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/g,
        firstCharSpecial: /^[^a-zA-Z0-9\s]/g,
        htmlEntities: /&[a-zA-Z0-9#]+;/g,
        urlEncodedScript: /(%3C|%3c).*script.*(%3E|%3e)/gi,
        unicodeScript: /\x3c.*script.*\x3e/gi,
    };

    // Error messages - Updated to match server-side strict validation
    const messages = {
        htmlTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        scriptTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        styleTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        iframeTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        objectTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        embedTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        appletTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        formTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        inputTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        textareaTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        selectTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        buttonTags: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        firstCharSpecial: 'The first character of the field cannot be a special character.',
        javascriptProtocol: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        vbscriptProtocol: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        dataProtocol: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        eventHandlers: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        cssExpressions: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        dangerousChars: 'Potentially dangerous characters are not allowed.',
        sqlPatterns: 'SQL injection patterns are not allowed.',
        controlChars: 'Invalid characters are not allowed.',
        htmlEntities: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        urlEncodedScript: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
        unicodeScript: '❌ Validation failed — HTML tags or JavaScript are not allowed.',
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
            
            // Find the parent input-group if it exists, otherwise use the field's parent
            const inputGroup = field.closest('.input-group');
            const targetParent = inputGroup ? inputGroup.parentNode : field.parentNode;
            
            // Insert error after the input-group or field
            if (inputGroup) {
                targetParent.insertBefore(errorElement, inputGroup.nextSibling);
            } else {
                targetParent.insertBefore(errorElement, field.nextSibling);
            }

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
            
            // Mark field as invalid for form validation
            field.dataset.htmlValidationInvalid = 'true';
        } else {
            errorElement.style.display = 'none';
            field.classList.remove('is-invalid');
            
            // Mark field as valid for form validation
            field.dataset.htmlValidationInvalid = 'false';
        }
        
        // Update form validation state
        updateFormValidationState(field);
    }

    /**
     * Update form validation state based on field validation
     */
    function updateFormValidationState(field) {
        const form = field.closest('form');
        if (!form) return;

        // Check if any field in the form is invalid
        const invalidFields = form.querySelectorAll('[data-html-validation-invalid="true"]');
        const hasInvalidFields = invalidFields.length > 0;

        // Add or remove form validation class
        if (hasInvalidFields) {
            form.classList.add('html-validation-invalid');
        } else {
            form.classList.remove('html-validation-invalid');
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
                field.dataset.htmlValidationInvalid = 'true';
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
                field.dataset.htmlValidationInvalid = 'false';
            }
        });

        // Update form validation state
        if (isValid) {
            form.classList.remove('html-validation-invalid');
        } else {
            form.classList.add('html-validation-invalid');
        }

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
                // Check if form has invalid fields
                const hasInvalidFields = form.classList.contains('html-validation-invalid');
                if (hasInvalidFields) {
                    e.preventDefault();
                    return false;
                }
                
                // Double-check with full validation
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
