#!/bin/bash
#save as syncwatch.sh
# Set the local and remote directories
local_dir="/home/master/Repos/cookery-corner/"
remote_dir="/var/www/html"
# Set the rsync options
rsync_options="-az  --progress "
# Start the loop to monitor for changes
while true; do
    # Use the inotifywait command to monitor for file changes in the local directory
    inotifywait -r -e modify,create,delete,move ${local_dir}
    # Trigger rsync to copy all changed files from local to remote
    # echo rsync ${rsync_options} ${local_dir}/ ${remote_dir}
    rsync ${rsync_options} -e 'ssh -p 22' ${local_dir}/ ${remote_dir}
done
