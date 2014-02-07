#misc aliases
alias ll="ls -lhac"
alias w1="watch --interval=1"

#misc functions
function p { 
	cd ~/projects/$1
}

function gpo {
	git push -u origin `git rev-parse --abbrev-ref HEAD`
}

function gca {
	git commit -a -m"$1"
}

function gco {
	git checkout $1
}

function gnb {
	git checkout master
	git pull
	git checkout -b $1
}

PS1='[\u@\h \w\[\033[32m\]$(__git_ps1)\[\033[0m\]]$ '
PATH="/usr/local/share/npm/bin:/usr/local/bin:/usr/local/sbin:$PATH"

export DOMAIN=jb.dev
export EDITOR="mate -w"
export APPLICATION_ENV=development
export JAVA_HOME="/System/Library/Frameworks/JavaVM.framework/Home"
export PROMPT_COMMAND='echo -ne "\033]0;${PWD/#$HOME/~} $(__git_ps1 " (%s)")"; echo -ne "\007"'

[[ -s "$HOME/.rvm/scripts/rvm" ]] && . "$HOME/.rvm/scripts/rvm"  # This loads RVM into a shell session.

if [ -f `brew --prefix`/etc/bash_completion ]; then
    . `brew --prefix`/etc/bash_completion
fi


alias phpd="php -d xdebug.remote_autostart=1"
