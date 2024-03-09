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
                    label: 'Ordering',
                    value: attributes.ordering,
                    onChange: (newValue) => setAttributes({ ordering: newValue }),
                }
            ),
            createElement(
                TextControl,
                {
                    type: 'number',
                    label: 'Page Size',
                    value: attributes.pageSize,
                    onChange: (newValue) => setAttributes({ pageSize: parseInt(newValue) }),
                }
            )
        );
    },
    save: function (props) {
        const { attributes } = props;
        return createElement(
            'div',
            null,
            [...Array(attributes.pageSize)].map((_, index) => (
                createElement(
                    'div',
                    { key: index, className: 'wp-gamefetcher-block' },
                    `[wp_gamefetcher ordering="${attributes.ordering}" page_size="1"]`
                )
            ))
        );
    },
});
