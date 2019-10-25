(() => {
    const ASSETS = __ASSETS__;
    const VERSION = '__VERSION__';
    const FUNCTION = '__FUNCTION__';

    const scriptsLoaded = Promise.all(ASSETS.map((url) => loadScript(url)));

    window[FUNCTION] = async (callback) => {
        await scriptsLoaded;
        callback();
    };

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

            document.head.addEventListener(
                'load',
                function(event) {
                    if (event.target === scriptElement) {
                        resolve();
                    }
                },
                true,
            );

            document.head.appendChild(scriptElement);
        });
    }
})();
