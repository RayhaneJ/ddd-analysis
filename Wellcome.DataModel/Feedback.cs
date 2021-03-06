using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    [Table("Feedback")]
    public class Feedback
    {
        public int ID { get; set; }
        public int Notation { get; set; }
        public DateTime TimeStamp { get; set; }
        public int UserId { get; set; }
        public virtual User User { get; set; }
        public string Remark { get; set; }
    }
}
