loadApp({
    version: '{FUNCTION}',
});

const ASSETS = { ASSETS };

/**
 *
 * @param {} version
 * @param {version?: string; ravenUrl?:string; callback?: ()=>void} options
 * @returns {Promise<void>}
 */
async function loadApp(options = {}) {
    options.version = options.version || '*';
    options.callback =
        options.callback ||
        (() => {
            console.info(`No callback defined in loader loadApp options.`);
        });

    const response = await (await fetch('{URL}?version=' + options.version)).json();

    try {
        console.log('Loading version ' + response.version);

        if (options.ravenUrl) {
            response.assets.js.push('https://cdn.ravenjs.com/3.27.0/raven.min.js');
        }

        for (const url of response.assets.css) {
            loadStyle(url);
        }

        await Promise.all(response.assets.js.map((url) => loadScript(url)));

        if (options.ravenUrl) {
            Raven.config(options.ravenUrl).install();
            Raven.setTagsContext({ version: response.version });
            Raven.context(() => {
                options.callback(window.BookViewerApp);
            });
        } else {
            options.callback(window.BookViewerApp);
        }
    } catch (error) {
        console.error('Error while loading BookViewerApp version ' + options.version);
        throw error;
    }
}

const headElement = document.getElementsByTagName('head')[0];

/**
 *
 * @param {script} url
 * @returns {Promise<void>}
 */
function loadScript(url) {
    return new Promise((resolve, reject) => {
        const scriptElement = document.createElement('script');

        scriptElement.setAttribute('type', 'text/javascript');
        scriptElement.setAttribute('src', url);

        headElement.addEventListener(
            'load',
            function(event) {
                if (event.target === scriptElement) {
                    resolve();
                }
            },
            true,
        );

        headElement.appendChild(scriptElement);
    });
}

/**
 *
 * @param {script} url
 */
function loadStyle(url) {
    const styleElement = document.createElement('link');
    styleElement.setAttribute('rel', 'stylesheet');
    styleElement.setAttribute('type', 'text/css');
    styleElement.setAttribute('href', url);
    headElement.appendChild(styleElement);
    console.log(styleElement);
}
