# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Run the container(s)
dump: ## Dump workflows
	php bin/console workflow:dump input | dot -Tpng -o graph-input.png
	php bin/console workflow:dump order | dot -Tpng -o graph-order.png
	php bin/console workflow:dump request | dot -Tpng -o graph-request.png
	php bin/console workflow:dump notification | dot -Tpng -o graph-notification.png
