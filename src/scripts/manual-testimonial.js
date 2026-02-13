// FYI this was an afterthought to allow for speedy manual addition of testimonials especially
// for spots where only one is required rather than the full array but pulling in a specific post or array of 
// posts like get posts does. No time to spend getting this working right now. Best to copy over quotes from 
// testimonials so they remain in one spot with the right template but are individually referenced in spots 
// around the site...
// therefore this is just the broken framework. to get it working you can uncomment 
// the import in src/scripts/block-mods.js

// add new manual testimonial variation to the query block

const { registerBlockVariation } = wp.blocks;
const { addFilter } = wp.hooks;
const { Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor || wp.editor;
const { PanelBody, ComboboxControl } = wp.components;
const { useSelect } = wp.data;

registerBlockVariation('core/query', {
    name: 'manual-testimonial',
    title: 'Manual Testimonials',
    description: 'Query loop restricted to manually chosen testimonial posts.',
    attributes: {
        query: {
            postType: 'allset_testimonial',
            include: [],
            perPage: 0
        }
    },
    isActive: (attrs) =>
        attrs?.query?.postType === 'allset_testimonial' &&
        Array.isArray(attrs?.query?.include)
});

// sidebar panel for adding posts via IDs

const TestimonialIncludePanel = (BlockEdit) => (props) => {
    const { attributes, setAttributes, name } = props;

    if (name !== 'core/query') return <BlockEdit {...props} />;

    const isVariation =
        attributes?.query?.postType === 'allset_testimonial' &&
        Array.isArray(attributes?.query?.include);

    if (!isVariation) return <BlockEdit {...props} />;

    const selectedIds = attributes.query.include || [];

    const posts = useSelect(
        (select) =>
            selectedIds.length
                ? select('core').getEntityRecords(
                      'postType',
                      'allset_testimonial',
                      { include: selectedIds }
                  )
                : [],
        [selectedIds]
    );

    const titles =
        posts?.map((p) => ({
            value: p.id,
            label: p.title.rendered
        })) || [];

    const searchPosts = async (search) => {
        const req = await wp.apiFetch({
            path: wp.url.addQueryArgs(
                '/wp/v2/allset_testimonial',
                { search }
            )
        });
        return req.map((p) => ({
            value: p.id,
            label: p.title.rendered
        }));
    };

    return (
        <Fragment>
            <BlockEdit {...props} />

            <InspectorControls>
                <PanelBody title="Specific Testimonials">
                    <ComboboxControl
                        label="Add testimonial"
                        value=""
                        onInputChange={() => {}}
                        onChange={(selected) => {
                            const id = parseInt(selected, 10);
                            if (id && !selectedIds.includes(id)) {
                                setAttributes({
                                    query: {
                                        ...attributes.query,
                                        include: [...selectedIds, id]
                                    }
                                });
                            }
                        }}
                        options={[]}
                        autocomplete={searchPosts}
                    />

                    {titles.length > 0 &&
                        titles.map((item) => (
                            <div key={item.value}>
                                {item.label}
                                <button
                                    type="button"
                                    onClick={() => {
                                        setAttributes({
                                            query: {
                                                ...attributes.query,
                                                include: selectedIds.filter(
                                                    (x) => x !== item.value
                                                )
                                            }
                                        });
                                    }}
                                >
                                    Remove
                                </button>
                            </div>
                        ))}
                </PanelBody>
            </InspectorControls>
        </Fragment>
    );
};

addFilter(
    'editor.BlockEdit',
    'testimonials-specific-query/controls',
    TestimonialIncludePanel
);
