# Pre-commit for the Form Builder

This guide is only for the Form Builder, but can extend for other projects.  Pre-commit is a tool that works with Git hooks for identifying issues before checking code into source code repository. [Read more](https://pre-commit.com/)

## Setup
1. Follow the official installation guide on [pre-commit.com](https://pre-commit.com/#install)

2. Git pull the required .pre-commit config file from master, this config file must be in your project's root folder
```
        git checkout origin/master -- .pre-commit-config.yaml
```

3. Check your local setup by running the following command, you should see some warnings and errors.
```
        pre-commit
```
4.  Warnings are expected since your files will likely not pass all the pre-commit checks. Errors mean some hooks need additional local installs, you will find installation instructions in the .pre-commit-config.yaml file.
> For php-linter to work, install php code sniffer from [https://github.com/squizlabs/PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
> For shellcheck to work, install from [https://github.com/koalaman/shellcheck#installing](https://github.com/koalaman/shellcheck#installing)
As more hooks are added, additional installs may be required, please update this document.


## Usage
Pre-commit works on staged files, that means when you add files to your commit, pre-commit knows these are the files to check for. **If you made changes to the staged files, you will need to need to git add the changed files again**

Run pre-commit after files are added.
```
        git commit -m " your commit message "
```