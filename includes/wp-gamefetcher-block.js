const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;
const { createElement } = wp.element;

registerBlockType('wp-gamefetcher/wp-gamefetcher-block', {
    title: 'WP GameFetcher Block',
    icon: 'shield',
    category: 'common',
    attributes: {
        ordering: {
            type: 'string',
            default: '-rating',
        },
        pageSize: {
            type: 'number',
            default: 5,
        },
    },
    edit: function (props) {
        const { attributes, setAttributes } = props;
        return createElement(
            'div',
            null,
            createElement(
                TextControl,
                {
                    label: __('Ordering', 'wp-gamefetcher'),
                    value: attributes.ordering,
                    onChange: (newValue) => setAttributes({ ordering: sanitize_text_field(newValue) }),
                }
            ),
            createElement(
                TextControl,
                {
                    type: 'number',
                    label: __('Page Size', 'wp-gamefetcher'),
                    value: attributes.pageSize,
                    onChange: (newValue) => setAttributes({ pageSize: parseInt(newValue) }),
                }
            )
        );
    },
    save: function (props) {
        const { attributes } = props;
        const shortcode = `[wp-gamefetcher ordering="${attributes.ordering}" page_size="${attributes.pageSize}"]`;

        return createElement('div', null, shortcode);
    },
});
