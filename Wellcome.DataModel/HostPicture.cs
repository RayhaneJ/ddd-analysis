using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    [Table("HostPicture")]
    public class HostPicture
    {
        public int ID { get; set; }
        public string Path { get; set; }
        public int HostId { get; set; }
        public virtual Host Host { get; set; }
    }
}
