/**
 * Shared components for Allsetzzz block
 */

// Until create-block pascal case is fixed, manually replace MyBlock in this components file
// it will use the alias in editor.js and save.js

import { InnerBlocks } from '@wordpress/block-editor';

function MyBlockContent({ children, className = '' }) {
	return (
		<header id="header" className="banner z-30 sticky top-0 transition duration-300 ease-in-out">
			<div id="navLayer" className="bg-secondary inset-0 z-10 h-screen w-screen origin-bottom scale-y-100 transition duration-500 group-data-[state=active]:origin-top group-data-[state=active]:scale-y-100 lg:hidden fixed"></div>
			
			<nav id="shortHead" className="bg-white w-full z-10 relative" aria-label="Primary Navigation">
				<div className="max-w-7xl mx-auto px-0 lg:px-12 xl:px-6">
					<div className="flex flex-wrap justify-center py-2 gap-6 md:py-4 md:gap-0 relative">
						
						<div className="relative z-20 w-full flex justify-center lg:w-max md:px-0">
							<a href="#home" aria-label="logo" className="flex space-x-2">
								<div aria-hidden="true" className="logo flex space-x-1">
									<div className="pr-6 lg:pr-8">
										<div className="flex">
											<div className="block lg:mr-4" href="/">
												<img
													className="max-w-full md:max-w-small w-auto mx-2 pr-[3rem]"
													src="/wp-content/themes/allset/resources/images/allset-logo-colour-horizontal.svg"
													alt="Allset Logo"
												/>
											</div>
										</div>
									</div>
								</div>
							</a>
							
							<div className="absolute top-[1.5rem] right-2 flex items-center lg:hidden max-h-10">
								<label role="button" htmlFor="toggle_nav" aria-label="hamburger" id="hamburger" className="relative p-6">
									<div aria-hidden="true" id="line" className="m-auto h-0.5 w-5 rounded bg-sky-900 dark:bg-gray-300 transition duration-300"></div>
									<div aria-hidden="true" id="line2" className="m-auto mt-2 h-0.5 w-5 rounded bg-sky-900 dark:bg-gray-300 transition duration-300"></div>
								</label>
							</div>
						</div>
						
						<div
							id="navMenu"
							className="flex-col z-20 flex-wrap gap-6 p-8 rounded-bl-3xl bg-white shadow-2xl shadow-gray-600/10 justify-end w-auto invisible opacity-0 absolute top-full right-0 transition-all duration-300 origin-top 
								lg:relative lg:scale-100 lg:flex lg:flex-row lg:items-center lg:gap-0 lg:p-0 lg:bg-transparent lg:w-7/12 lg:visible lg:opacity-100 lg:border-none lg:shadow-none"
						>
							<div className="text-gray-600 dark:text-gray-300 lg:pr-4 lg:w-auto w-full lg:pt-0">
								{children}
							</div>
							
							<div className="mt-8 lg:mt-0">
								<a
									href="#contact"
									className="relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-md before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max"
								>
									<span className="relative text-sm font-semibold text-white">Contact</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</header>
	);
}

// Export the clear PascalCase name for clarity, and an alias called Content
export const Content = MyBlockContent;
export default MyBlockContent;