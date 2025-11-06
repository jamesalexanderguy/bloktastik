import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { Content } from './components';

export default function Edit() {
	const blockProps = useBlockProps();
	
	return (
		<div {...useBlockProps()}>
			<Content>
				<InnerBlocks 
					allowedBlocks={['core/navigation']} 
					template={[['core/navigation']]} 
				/>
			</Content>
		</div>
	);
}
