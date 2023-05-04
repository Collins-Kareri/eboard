interface LogoProps extends React.ComponentPropsWithRef<"h1"> {}

function Logo({ className, ...rest }: LogoProps) {
    return (
        <h1 className={`tw-text-2xl ${className}`} {...rest}>
            Eboard
        </h1>
    );
}

export default Logo;
