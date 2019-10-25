(() => {
    const ASSETS = __ASSETS__;
    const VERSION = '__VERSION__';
    const FUNCTION = '__FUNCTION__';
    const EXPORTS = '__EXPORTS__';

    const scriptsLoaded = new Promise((resolve) => {
        //TODO: In get params wait strategy before start loading
        requestAnimationFrame(async () => {
            await Promise.all(ASSETS.map((url) => loadScript(url)));
            resolve();
        });
    });

    window[FUNCTION] = async (callback) => {
        await scriptsLoaded;

        if (EXPORTS !== 'null') {
            try {
                const exported = __EXPORTS__;
                callback(exported);
            } catch (error) {
                console.error(error);
                throw new Error(`Scripts in version "${VERSION}" did not declare window.${EXPORTS}.`);
            }
        } else {
            callback();
        }
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
