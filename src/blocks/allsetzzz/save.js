import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { Content } from './components';

export default function save() {
  const blockProps = useBlockProps.save(); 
  return (
    <div {...blockProps}>
      <Content>
		<InnerBlocks.Content />
      </Content>
	  
    </div>
  );
}
